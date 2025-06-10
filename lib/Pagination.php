<?php
/**
 * CodexWorld is a programming blog. Our mission is to provide the best online resources on programming and web development.
 *
 * This Pagination class helps to integrate ajax pagination in PHP.
 *
 * @class		Pagination
 * @author		CodexWorld
 * @link		http://www.codexworld.com
 * @contact		http://www.codexworld.com/contact-us
 * @version		1.0
 */
class Pagination {
    var $baseURL = '';
    var $totalRows = '';
    var $perPage = 10;
    var $numLinks = 2;
    var $currentPage = 0;
    var $firstLink = '<i class="glyphicon glyphicon-chevron-left"></i> Awal';
    var $nextLink = '<i class="glyphicon glyphicon-chevron-right"></i>';
    var $prevLink = '<i class="glyphicon glyphicon-chevron-left"></i>';
    var $lastLink = 'Akhir <i class="glyphicon glyphicon-chevron-right"></i>';
    var $fullTagOpen = '<ul class="pagination">';
    var $fullTagClose = '</ul>';
    var $firstTagOpen = '<li>';
    var $firstTagClose = '</li>';
    var $lastTagOpen = '<li>';
    var $lastTagClose = '</li>';
    var $curTagOpen = '<li class="active"><a href="#">';
    var $curTagClose = '</a></li>';
    var $nextTagOpen = '<li>';
    var $nextTagClose = '</li>';
    var $prevTagOpen = '<li>';
    var $prevTagClose = '</li>';
    var $numTagOpen = '<li>';
    var $numTagClose = '</li>';
    var $anchorClass = '';
    var $showCount = false;
    var $currentOffset = 0;
    var $contentDiv = '';
    var $additionalParam = '';

    function __construct($params = array()) {
        if (count($params) > 0) {
            $this->initialize($params);
        }
        if ($this->anchorClass != '') {
            $this->anchorClass = 'class="' . $this->anchorClass . '" ';
        }
    }

    function initialize($params = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    function createLinks() {
        if ($this->totalRows == 0 || $this->perPage == 0) {
            return '';
        }

        $numPages = ceil($this->totalRows / $this->perPage);

        if ($numPages == 1) {
            if ($this->showCount) {
                $info = 'Showing : ' . $this->totalRows;
                return $info;
            } else {
                return '';
            }
        }

        if (!is_numeric($this->currentPage)) {
            $this->currentPage = 0;
        }

        $output = '';

        if ($this->showCount) {
            $currentOffset = $this->currentPage;
            $info = 'Showing ' . ($currentOffset + 1) . ' to ';
            if (($currentOffset + $this->perPage) < ($this->totalRows - 1)) {
                $info .= $currentOffset + $this->perPage;
            } else {
                $info .= $this->totalRows;
            }
            $info .= ' of ' . $this->totalRows . ' | ';
            $output .= $info;
        }

        $this->numLinks = (int)$this->numLinks;

        if ($this->currentPage > $this->totalRows) {
            $this->currentPage = ($numPages - 1) * $this->perPage;
        }

        $uriPageNum = $this->currentPage;
        $this->currentPage = floor(($this->currentPage / $this->perPage) + 1);

        $start = (($this->currentPage - $this->numLinks) > 0) ? $this->currentPage - ($this->numLinks - 1) : 1;
        $end = (($this->currentPage + $this->numLinks) < $numPages) ? $this->currentPage + $this->numLinks : $numPages;

        if ($this->currentPage > $this->numLinks) {
            $output .= $this->firstTagOpen . $this->getAJAXlink('', $this->firstLink) . $this->firstTagClose;
        }

        if ($this->currentPage != 1) {
            $i = $uriPageNum - $this->perPage;
            if ($i == 0) $i = '';
            $output .= $this->prevTagOpen . $this->getAJAXlink($i, $this->prevLink) . $this->prevTagClose;
        }

        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = ($loop * $this->perPage) - $this->perPage;
            if ($i >= 0) {
                if ($this->currentPage == $loop) {
                    $output .= $this->curTagOpen . $loop . $this->curTagClose;
                } else {
                    $n = ($i == 0) ? '' : $i;
                    $output .= $this->numTagOpen . $this->getAJAXlink($n, $loop) . $this->numTagClose;
                }
            }
        }

        if ($this->currentPage < $numPages) {
            $output .= $this->nextTagOpen . $this->getAJAXlink($this->currentPage * $this->perPage, $this->nextLink) . $this->nextTagClose;
        }

        if (($this->currentPage + $this->numLinks) < $numPages) {
            $i = (($numPages * $this->perPage) - $this->perPage);
            $output .= $this->lastTagOpen . $this->getAJAXlink($i, $this->lastLink) . $this->lastTagClose;
        }

        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        $output = $this->fullTagOpen . $output . $this->fullTagClose;

        return $output;
    }

    function getAJAXlink($count, $text) {
        if ($this->contentDiv == '') {
            return '<a href="' . $this->anchorClass . ' ' . $this->baseURL . $count . '">' . $text . '</a>';
        }

        $pageCount = $count ? $count : 0;
        $this->additionalParam = "{'page' : $pageCount}";

        return "<a href=\"javascript:void(0);\" " . $this->anchorClass . "
                onclick=\"$.post('" . $this->baseURL . "', " . $this->additionalParam . ", function(data){
                       $('#" . $this->contentDiv . "').html(data); }); return false;\">" . $text . '</a>';
    }
}
?>