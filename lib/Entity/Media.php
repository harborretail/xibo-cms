<?php
/*
 * Xibo - Digital Signage - http://www.xibo.org.uk
 * Copyright (C) 2015 Spring Signage Ltd
 *
 * This file (Media.php) is part of Xibo.
 *
 * Xibo is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Xibo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Xibo.  If not, see <http://www.gnu.org/licenses/>.
 */


namespace Xibo\Entity;


class Media
{
    public $mediaId;
    public $ownerId;
    public $parentId;

    public $name;
    public $mediaType;
    public $storedAs;
    public $fileName;
    public $tags;

    public $fileSize;
    public $duration;
    public $valid;
    public $moduleSystemFile;
    public $expires;

    // Read only properties
    public $owner;
    public $groupsWithPermissions;

    public function getId()
    {
        return $this->mediaId;
    }

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function Delete()
    {
        $media = new \Media();
        if (!$media->Delete($this->mediaId))
            throw new \Exception($media->GetErrorMessage());
    }
}