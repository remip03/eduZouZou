<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerZp8tshx\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerZp8tshx/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerZp8tshx.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerZp8tshx\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerZp8tshx\App_KernelDevDebugContainer([
    'container.build_hash' => 'Zp8tshx',
    'container.build_id' => 'd2a98553',
    'container.build_time' => 1724836893,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerZp8tshx');
