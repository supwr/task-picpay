<?php

namespace App\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractContextAwareFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

final class UsersSearchFilter extends AbstractContextAwareFilter
{

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $rootAlias = $queryBuilder->getRootAliases()[0];

        if($property !== 'q'){
            return;
        }

        $queryBuilder->join(sprintf('%s.accounts', $rootAlias), 'accounts')
            ->where(sprintf('%s.fullName like :q', $rootAlias))
            ->orWhere(sprintf('accounts.username like :q', $rootAlias))
            ->setParameter('q', $value.'%');

    }

    // This function is only used to hook in documentation generators (supported by Swagger and Hydra)
    public function getDescription(string $resourceClass): array
    {
        if (!$this->properties) {
            return [];
        }

        $description = [];
        foreach ($this->properties as $property => $strategy) {
            $description["regexp_$property"] = [
                'property' => $property,
                'type' => 'string',
                'required' => false,
                'swagger' => [
                    'description' => 'Filters user by name or account username',
                    'name' => 'User filter',
                    'type' => 'Query string',
                ],
            ];
        }

        return $description;
    }

}