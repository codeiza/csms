<?php
class Paginator{
	public function __construct($total_cnt,$mid_range) {
		$this->total_items = (int) $total_cnt;
		if($this->total_items <= 0) exit;
		$this->mid_range = (int) $mid_range; // midrange must be an odd int >= 1
		if($this->mid_range%2 == 0 Or $this->mid_range < 1) exit("Unable to paginate: Invalid mid_range value (must be an odd integer >= 1)");
		$this->items_per_page = $_REQUEST["perpage"];
		$this->num_pages = 1;
		$this->num_pages = ceil($this->total_items/$this->items_per_page);
		$this->current_page = $_REQUEST["page"]; // must be numeric > 0
		if($this->num_pages > 0) {
			$this->return = ($this->current_page > 1 And $this->total_items >= 0) ? "<li title=\"Back to page  ".(intVal($this->current_page) - 1 )."\"><span id=\"preview\">Prev</span></li>":"<li title=\"Disabled\" disabled><span>Prev</span></li>";
			$this->start_range = $this->current_page - floor($this->mid_range/2); 
			$this->end_range = $this->current_page + floor($this->mid_range/2);
			if($this->start_range <= 0) {
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages) {
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);
			for($i=1;$i<=$this->num_pages;$i++) {
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " <li><span>...</span></li> ";
				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range)) $this->return .= ($i == $this->current_page) ? "<li  class=\"active\" title=\"Go to page $i of $this->num_pages\" ><span class=\"page\">$i</span></li>\n":"<li title=\"Go to page $i of $this->num_pages\" ><span class=\"page\">$i</span></li>\n";
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= "<li><span>...</span></li>";
			}
			$this->return .= (($this->current_page < $this->num_pages And $this->total_items >= 5) And ($this->items_per_page != "All") And $this->current_page > 0) ? "<li title=\"Go to page  ".(	($this->current_page) + 1 )."\"><span id=\"next\">Next</span></li>\n":"<li title=\"Disabled\"><span>Next</span></li>\n";
		}
	}
	public function display_pages() {
		return $this->return;
	}
}