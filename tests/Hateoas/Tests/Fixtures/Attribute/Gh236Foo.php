<?php

declare(strict_types=1);

namespace Hateoas\Tests\Fixtures\Attribute;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

#[Hateoas\Relation(
    'b_embed',
    embedded: new Hateoas\Embedded(
        'expr(object.b)',
        exclusion: new Hateoas\Exclusion(maxDepth: 1),
    ),
)]
class Gh236Foo
{
    #[Serializer\Expose]
    #[Serializer\MaxDepth(1)]
    public $a;

    #[Serializer\Exclude]
    public $b;

    public function __construct()
    {
        $this->a = new Gh236Bar();
        $this->a->inner = new Gh236Bar();

        $this->b = new Gh236Bar();
        $this->b->xxx = 'zzz';
        $this->b->inner = new Gh236Bar();
    }
}
