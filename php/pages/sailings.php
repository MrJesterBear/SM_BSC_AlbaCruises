<?php 
// Sual Maylin 21005729
//  09/11/2025
// v1
// Sailings class page.

class Sailings {
    private $callingName;
    private $destinationName;
    private $departureDate;
    private $departureTime;
    private $arivalTime;
    private $option;
    private $type;

    public function __construct($callingName, $destinationName, $departureDate, $departureTime, $arivalTime, $option, $type) {
        $this->callingName = $callingName;
        $this->destinationName = $destinationName;
        $this->departureDate = $departureDate;
        $this->departureTime = $departureTime;
        $this->arivalTime = $arivalTime;
        $this->option = $option;
        $this->type = $type;
        $this->renderSailing();
    }

    public function renderSailing() {
        echo '<div class="col" id="' . $this->option . '">',
            '<p class="text-white font-weight-bold">'. date_format($this->departureDate, 'l d/m') . '</p>',
            '<div>',
              '<p>'.$this->callingName.'<br> '.$this->departureTime.'</p>',
              '<p>&#8595;</p>',
              '<p>'.$this->destinationName.' <br> '.$this->arivalTime.'</p>',
            '</div>',
            '<button class="btn primary-button" onclick="select'.$this->type.'(' . $this->option . ')">Select </button>',
          '</div>';
    }
}
?>