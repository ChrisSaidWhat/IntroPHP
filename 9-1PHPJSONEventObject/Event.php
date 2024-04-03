<?php

    class Event implements JsonSerializable {
        //  utilized JetBrains AI to get the properties to be private but still encode to JSON
        private $event_presenter;
        private $event_date;
        private $event_time;
        private $event_id;
        private $event_name;
        private $event_description;

        function __construct() {

            $this->event_id = 0;
            $this->event_name = "";
            $this->event_description = "";
            $this->event_presenter = "";
            $this->event_date = "";
            $this->event_time = "";
            
        }

        function get_event_id() {
            return $this->event_id;
        }

        function set_event_id($inId) {
            $this->event_id = $inId;
        }

        function get_event_name() {
            return $this->event_name;
        }

        function set_event_name($inName) {
            $this->event_name = $inName;
        }

        function get_event_description() {
            return $this->event_description;
        }

        function set_event_description($inDesc) {
            $this->event_description = $inDesc;
        }

        function get_event_presenter() {
            return $this->event_presenter;
        }

        function set_event_presenter($inPresenter) {
            $this->event_presenter = $inPresenter;
        }

        function get_event_date() {
            return $this->event_date;
        }

        function set_event_date($inDate) {
            $this->event_date = $inDate;
        }

        function get_event_time() {
            return $this->event_time;
        }

        function set_event_time($inTime) {
            $this->event_time = $inTime;
        }

        public function jsonSerialize() {
            return [
                'event_id' => $this->event_id,
                'event_name' => $this->event_name,
                'event_description' => $this->event_description,
                'event_presenter' => $this->event_presenter,
                'event_date' => $this->event_date,
                'event_time' => $this->event_time,
            ];
        }
    }