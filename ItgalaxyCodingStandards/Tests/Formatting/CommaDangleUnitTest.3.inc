<?php
fooCall($arg1, $arg2, $arg3,);
fooCall(
    $arg1,
    $arg2,
    $arg3,
);

// Inheriting variables from the parent scope in anonymous functions
$foo = function ($bar) use (
    $a,
    $b,
    $c,
) {
    // ...
};

class Foo extends Bar implements
    // Interface implementations on a class
    FooInterface,
    BarInterface,
    BazInterface,
{
    // Trait implementations on a class
    use
        FooTrait,
        BarTrait,
        BazTrait,
        ;

    // Class member lists
    const
        A = 1010,
        B = 1021,
        C = 1032,
        D = 1043,
    ;
    protected
        $a = 'foo',
        $b = 'bar',
        $c = 'baz',
    ;
    private
        $blah,
    ;

    public function something(FooBarBazInterface $in, FooBarBazInterface $out,) : bool
    {
        // ...
    }
}

foo(
    ...$args,
    ...$moreArgs,
    ...$evenMoreArgs,
);
