<?php

namespace Wya\PhpSpreadsheet\Shared\Escher\DggContainer;

class BstoreContainer
{
    /**
     * BLIP Store Entries. Each of them holds one BLIP (Big Large Image or Picture).
     *
     * @var array
     */
    private $BSECollection = [];

    /**
     * Add a BLIP Store Entry.
     *
     * @param BstoreContainer\BSE $BSE
     */
    public function addBSE($BSE)
    {
        $this->BSECollection[] = $BSE;
        $BSE->setParent($this);
    }

    /**
     * Get the collection of BLIP Store Entries.
     *
     * @return BstoreContainer\BSE[]
     */
    public function getBSECollection()
    {
        return $this->BSECollection;
    }
}
