<?php
class MessageParser {
  public static function parseMessage($message) {
    $xml = simplexml_load_string($message);
    $data = array();

    // extract the message metadata
    $data['source_sim'] = (string) $xml->simNumber;
    $data['sender_name'] = (string) $xml->senderName;
    $data['sender_email'] = (string) $xml->senderEmail;

    // extract the message content
    $data['switch1'] = (string) $xml->switch1;
    $data['switch2'] = (string) $xml->switch2;
    $data['switch3'] = (string) $xml->switch3;
    $data['switch4'] = (string) $xml->switch4;
    $data['fan'] = (string) $xml->fan;
    $data['heater'] = (float) $xml->heater;
    $data['keypad'] = (int) $xml->keypad;

    return $data;
  }
}
?>
