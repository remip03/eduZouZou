<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

<<<<<<< HEAD
if (\class_exists(\ContainerFSTrg9H\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerFSTrg9H/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerFSTrg9H.legacy');
=======
if (\class_exists(\Container82jhBUT\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container82jhBUT/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container82jhBUT.legacy');
>>>>>>> 94f0e95efbee87b3177b2b395bd5adc824cfbd87

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
<<<<<<< HEAD
    \class_alias(\ContainerFSTrg9H\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerFSTrg9H\App_KernelDevDebugContainer([
    'container.build_hash' => 'FSTrg9H',
    'container.build_id' => '001519f4',
    'container.build_time' => 1722252090,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerFSTrg9H');
=======
    \class_alias(\Container82jhBUT\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container82jhBUT\App_KernelDevDebugContainer([
    'container.build_hash' => '82jhBUT',
    'container.build_id' => 'f528a2b4',
    'container.build_time' => 1722252361,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'Container82jhBUT');
>>>>>>> 94f0e95efbee87b3177b2b395bd5adc824cfbd87
