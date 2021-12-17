# Domain Driven Design Starter Kit
The core idea of this library is to get started with essential elements for a DDD implementation while keeping the content as thin as possible.


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

# Application

# Infrastructure
## Repository
## Identity

# Tools
## Collection
## Specifications
Specification pattern is there to support collection or repository element filtering.
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
### Usage
Here is an example in common use cas like finding specific records matching conditions.
```php
/**
 * Some repository class implementing the entity repository interface methods.
 **/
class SomeRepository extends ORMBaseRepository implements EntityRepositoryInterface {
    public function find(ISpecification $specification): self {
        return $this->satisfiedBy($specification);
    }
}

/**
 * Some ORM repository implementing the necessary methods to run queries 
 */
class ORMBaseRepository implements \Ngirardet\PhpDdd\Domain\Repository\IRepository {
    /**
     * Method to find specific records based on specifications 
     * @param \ISpecification $specification
     * @return $this
     */
    protected function satisfiedBy(ISpecification $specification): static {
        $cloned = clone $this->orm;
        $cloned->results = array_filter($this->orm->queryResult(), [$specification, 'isSatisfiedBy']);

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
