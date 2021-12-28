# Domain Driven Design Boilerplate
The core idea of this library is to get started with essential elements for a DDD implementation while keeping the dependencies as minimum as possible.

## Development state
### Todo
- Improve Specification pattern. When called from _Application layer_ and targeting a query builder, the `getSpecExpression` method should be bound lately by or through the **Repository**.   

## Folder structure

### Suggestions for your development
#### Folder structure
```text
src/
 | Domain/
   | Entity/
     | Collection/
     | Repository/
 | Infrastructure/
   | Helper/
     | Identity/
```

# Domain
## Entity
### Factory class or factory method
There are two reasons to instantiate an entity, either for creation or reconstruction purpose.

Creating an entity occurs when the entity hasn't been saved yet and does not exist in the repository. When creating, the entity has no ID yet.

Reconstructing an entity occurs when the entity is retrieved from the repository and needs to be "rehydration".

An entity can be created with the constructor or with a static method `create`. In the later case, the entity constructor should be private to avoid public usage.
The main advantage to a private constructor is to have complete freedom on constructor arguments.

It's suggested to create two static method: `create` and `reconstructe`. Usually, `create`'s method signature is the same as `reconstructe` without the `ID` argument. When it's possible, `create` calls `reconstructe`.
# Application
## Service
### When to use a service
Application Services are convenient to define some control logic inherent to the application layer. For instance, when your application applies rules before registering a user, such as is the username already registered.
The service should receive a DTO, check rules, instantiates a new domain entity (either through the entity factory, if existing or with the entity constructor) and pass the entity to the repository.

If no service is needed, the domain entity should be instantiated through a factory. The factory can be either a static method of the entity class or a static method of a dedicated entity factory class.

# Infrastructure
## Repository
## Identity

# Tools
## Collection
## Specifications
Specification pattern is there to support collection or repository element filtering.

###Specification for collections
Create your own specification class by extending `Ngirardet\PhpDdd\Common\Specification\BaseSpecification` and implement your own `getSpecExpression` **protected** method.
```php
class PriceSpecification extends \Ngirardet\PhpDdd\Common\Specification\BaseSpecification {
    private float $maxPrice;

    /**
    * @param float $minPrice Required minimum inclusive price
    * @param float|null $maxPrice Maximum inclusive price or equal $minPrice if null
    **/
    public function __construct(private float $minPrice, ?float $maxPrice = null) {
        $this->maxPrice = $maxPrice ?? $this->minPrice; // $this->maxPrice will equal $this->minPrice if omitted
    }

    /**
     * @param \Domain\Entity\Entity $element Element with a getPrice(): float method
     */
    protected function getSpecExpression(mixed $element): callable {
        return fn () => $element->getPrice() >= $this->minPrice && $element->getPrice() <= $this->maxPrice;
    }
}
```
### Specification for ORM/Query
You'll need an abstract factory to properly interact with specifications for queries.
The abstract factory class is an interface between the layer of the service (domain or application) and the infrastructure. It contains a list of methods the client will call when resolving a Specification.
```php
// Example of a specification factory for the user root aggregate
namespace Domain\Model\User;

interface IUserSpecificationsFactory {
    public function alreadyRegisteredUser(string $email, string $username);
}
```
The implementation of the abstract factory interface:
```php
namespace Infrastructure\User\Specification;

class UserSpecificationsFactory implements \Domain\Model\User\IUserSpecificationsFactory {
    public function alreadyRegisteredUser(string $email, string $username): \Ngirardet\PhpDdd\Common\Specification\ISpecification {
        return new \Infrastructure\User\Specification\UserAlreadyRegisteredSpecification($email, $username);
    }
}
```
And here's the specification for the ORM:
```php
namespace Infrastructure\User\Specification;

class UserAlreadyRegisteredSpecification extends \Ngirardet\PhpDdd\Common\Specification\BaseSpecification {
    public function __construct(private string $email, private string $username) {}

    /**
     * @param \Cake\ORM\Query $query
     */
    protected function getSpecExpression(mixed $query): callable {
        $query->where(
            ['OR' => [
                'username' => $this->username,
                'email' => $this->email
            ]]
        );

        return fn () => true; // BaseSpecification expects a callable
    }
}
```

Lastly, we inject the dependency in the service:
```php
class UserService {
    public function __construct(private IUserRepository $userRepository, private IUserSpecificationFactory $specificationFactory) {}
    ...
    public function register(string $email, string $username) {
        $this->userRepository->find($this->specificationFactory->alreadyRegisteredUser($email, $username));
    }
}

// Usage
class UsersController {
    public function register() {
        ...
        $repository = new \Infrastructure\User\UserRepository();
        $specificationsFactory = new \Infrastructure\User\UserSpecificationsFactory();
        $service = new \Application\User\UserService($repository, $specificationsFactory);
        $service->register($request->email, $request->username);
        ...
    }
}
```


### Usage
Here is an example in common use case like finding specific records matching conditions.
```php
/**
 * Some repository class implementing the repository interface methods.
 **/
class SomeRepository extends ORMBaseRepository implements SomeRepositoryInterface {
    public function find(ISpecification $specification): self {
        return $this->satisfiedBy(static fn ($queryBuilder) => $specification->isSatisfiedBy($queryBuilder));
    }
}

/**
 * Some ORM repository implementing the necessary methods to run queries 
 */
class ORMBaseRepository implements \Ngirardet\PhpDdd\Domain\Repository\IRepository {
    /**
     * Method to find specific records based on specifications 
     * @param callable $callbackFilter
     * @return $this
     */
    protected function isSatisfiedBy(callable $callbackFilter): static {
        $cloned = clone $this;
        $callabackFilter($cloned->queryBuilder);

        return $cloned;
    }
}

// Custom specification
$repository->find(new StateSpecification(State::DISABLED()));

// OrSpecification, matches at least one condition
$repository->find(new OrSpecification(new PriceSpecification(50.5), new StateSpecification(State::DISABLED())));

// AndSpecification, matches all the conditions
$repository->find(new AndSpecification(new PriceSpecification(50.5), new StateSpecification(State::ACTIVE())));
```

## Value Objects
Value Objects (aka Value Types) are Enumerators. They are perfect to define entity state or values that don't need an ID.

To create a value object by adding `Ngirardet\PhpDdd\Common\BaseEnum` trait.
Declare private constants and there related public static method.
You may want to consider extending `\Ngirardet\PhpDdd\Domain\Entity\ValueObject` class to implement `isSameAs` method.
```php
class MyValueObject extends \Ngirardet\PhpDdd\Domain\Entity\ValueObject {
    use \Ngirardet\PhpDdd\Common\BaseEnum;
    
    private const MY_CONST = 'Some string or integer value';
    
    public static function MY_CONST(): self {
        return self::constant(self::MY_CONST);
    }
    
    /**
     * @param MyValueObject $compareTo
     *
     * @return bool
     */
    public function isSameAs(ValueObject $compareTo): bool {
        return $this === $compareTo;
    }
}

// Usage
// Assuming we have an Entity class like this one
class Entity implements \Ngirardet\PhpDdd\Domain\Entity\IAggregateRoot {
    public function __construct(private EntityId $id, private MyValueObject $valueObject) {}
}

// Instantiating an entity would look like
$id = new EntityId(...);
new Entity($id, MyValueObject::MY_CONST());
```
# Dev Tools
## In Memory Repository
`InMemoryRepository` abstract class simulates a repository engine, such as a DBMS, in memory. It's useful for running integration tests without needing a DB infrastructure.

To use InMemoryRepository, add php-ddd test namespace in your psr4 option composer.json autoload-dev.
```json lines
{
  "autoload-dev": {
    "psr-4": {
      "Ngirardet\\PhpDdd\\Test\\": "vendor/ngirardet/php-ddd/tests/"
    }
  }
}
```
Run the following command in console: `composer dumpautoload`.

In your `tests\Fixture\Infrastructure\Repository` folder, create a new class for your aggregate root entity. This class must extends `Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Repository\InMemoryRepository` and implements `...\Domain\YourAggregate\RepositoryInterface`.
`YourAggregateRepositoryInterface` declares methods the repository must handle, i.e: `save`, `find`,...
