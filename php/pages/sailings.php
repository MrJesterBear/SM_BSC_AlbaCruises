<?php 
// Saul Maylin 21005729
//  17/11/2025
// v1.1
// Sailings class page.

class Sailings {
  private $timetableID;
    private $callingName;
    private $destinationName;
    private $departureDate;
    private $departureTime;
    private $arivalTime;
    private $option;
    private $type;
    private $formattedDate;

    public function __construct($timetableID, $callingName, $destinationName, $departureDate, $departureTime, $arivalTime, $option, $type) {
        $this->timetableID = $timetableID;
        $this->callingName = $callingName;
        $this->destinationName = $destinationName;
        $this->departureDate = $departureDate;
        $this->formattedDate = date_create($departureDate);
        $this->departureTime = $departureTime;
        $this->arivalTime = $arivalTime;
        $this->option = $option;
        $this->type = $type;
        // $this->renderSailing();
    }

    public function renderSailing() {
      $mobileview = null;

      if ($this->option == 3) {
        $mobileview = "destroy-on-mobile";
      }

        echo '<div class="col ' . $mobileview . '" id="departing' . $this->option . '">',
            '<p class="text-white font-weight-bold">'. date_format($this->formattedDate, 'l d/m') . '</p>',
            '<div class = "secondary-background">',
              '<p>'.$this->callingName.'<p> '.$this->departureTime.'</p> </p>',
              '<p>&#8595;</p>',
              '<p>'.$this->destinationName.' <p> '.$this->arivalTime.'</p> </p>',
            '</div>',
              '<form class ="'.$this->type.'form" onsubmit="return select'.$this->type.'(event, ' . $this->option . ')">',
              '<input type="hidden" class="'.$this->type.'TimetableID'.$this->option.'" name="timetableID" value="'.$this->timetableID.'">',
              '<input type="hidden" class="'.$this->type.'CallingName'.$this->option.'" name="callingName" value="'.$this->callingName.'">',
              '<input type="hidden" class="'.$this->type.'DestinationName'.$this->option.'" name="destinationName" value="'.$this->destinationName.'">',
              '<input type="hidden" class="'.$this->type.'DepartDate'.$this->option.'" name="departureDate" value="'.$this->departureDate.'">',
              '<button type = "submit" id="'.$this->type.'button'.$this->option.'" class="btn primary-button">Select </button>',
              '</form>',
            '</div>';
    }
}
?>