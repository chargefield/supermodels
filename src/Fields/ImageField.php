<?php

namespace Chargefield\Supermodel\Fields;

use Chargefield\Supermodel\Exceptions\InvalidImageFileException;
use Illuminate\Http\UploadedFile;

class ImageField extends Field
{
    /**
     * @var string
     */
    protected string $path = 'images';

    /**
     * @var bool
     */
    protected bool $withOriginalName = false;

    /**
     * @var string|null
     */
    protected ?string $disk = null;

    /**
     * @return $this
     */
    public function withOriginalName(): self
    {
        $this->withOriginalName = true;

        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @param string $disk
     * @return $this
     */
    public function disk(string $disk): self
    {
        $this->disk = $disk;

        return $this;
    }

    /**
     * @param array $fields
     * @return string
     */
    public function handle(array $fields = [])
    {
        $file = parent::handle($fields);

        if (is_null($file)) {
            return null;
        }

        if (! ($file instanceof UploadedFile)) {
            throw new InvalidImageFileException($file);
        }

        $disk = $this->disk ?? config('filesystems.default');

        if ($this->withOriginalName) {
            return $file->storeAs($this->path, $file->getClientOriginalName(), ['disk' => $disk]);
        }

        return $file->store($this->path, ['disk' => $disk]);
    }
}
