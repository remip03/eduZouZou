<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerKtcQKpm\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerKtcQKpm/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerKtcQKpm.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerKtcQKpm\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerKtcQKpm\App_KernelDevDebugContainer([
    'container.build_hash' => 'KtcQKpm',
    'container.build_id' => '927e5984',
    'container.build_time' => 1724170131,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerKtcQKpm');
