<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerNeKVkPK\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerNeKVkPK/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerNeKVkPK.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerNeKVkPK\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerNeKVkPK\App_KernelDevDebugContainer([
    'container.build_hash' => 'NeKVkPK',
    'container.build_id' => '3405f1a5',
    'container.build_time' => 1725001252,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerNeKVkPK');
