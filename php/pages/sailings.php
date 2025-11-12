<?php 
// Saul Maylin 21005729
//  11/11/2025
// v1.1
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
      $mobileview = null;

      if ($this->option == 3) {
        $mobileview = "destroy-on-mobile";
      }

        echo '<div class="col ' . $mobileview . '" id="departing' . $this->option . '">',
            '<p class="text-white font-weight-bold">'. date_format($this->departureDate, 'l d/m') . '</p>',
            '<div>',
              '<p>'.$this->callingName.'<p> '.$this->departureTime.'</p> </p>',
              '<p>&#8595;</p>',
              '<p>'.$this->destinationName.' <p> '.$this->arivalTime.'</p> </p>',
            '</div>',
            '<button class="btn primary-button" onclick="select'.$this->type.'(' . $this->option . ')">Select </button>',
          '</div>';
    }
}
?>