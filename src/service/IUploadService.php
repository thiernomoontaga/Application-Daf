<?php

namespace Src\Service;

interface IUploadService {

    public function upload(string $path, array $options = []): ?string;
}