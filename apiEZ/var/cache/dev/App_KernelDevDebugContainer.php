<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerNTqvDDR\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerNTqvDDR/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerNTqvDDR.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerNTqvDDR\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerNTqvDDR\App_KernelDevDebugContainer([
    'container.build_hash' => 'NTqvDDR',
    'container.build_id' => '44aaab77',
    'container.build_time' => 1725020215,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerNTqvDDR');
