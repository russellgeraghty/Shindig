<?php

namespace Rosesareblue\JenkinsBundle\Forms;

/**
 * A form for building the correct URL for the monitor.
 *
 * @author russell.geraghty
 */
class BuildForm {

    protected $buildName;
    protected $refresh;
    protected $buildUrl;

    public function getBuildName() {
        return $this->buildName;
    }

    public function setBuildName($buildName) {
        $this->buildName = $buildName;
    }

    public function getRefresh() {
        return $this->refresh;
    }

    public function setRefresh($refresh) {
        $this->refresh = $refresh;
    }

    public function getBuildUrl() {
        return $this->buildUrl;
    }

    public function setBuildUrl($buildUrl) {
        $this->buildUrl = $buildUrl;
    }

}

?>
