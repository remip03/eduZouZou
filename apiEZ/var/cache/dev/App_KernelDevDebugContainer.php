<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerXcW0apA\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerXcW0apA/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerXcW0apA.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerXcW0apA\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerXcW0apA\App_KernelDevDebugContainer([
    'container.build_hash' => 'XcW0apA',
    'container.build_id' => '8d17381b',
    'container.build_time' => 1724249123,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerXcW0apA');
