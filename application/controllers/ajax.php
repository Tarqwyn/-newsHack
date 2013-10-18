<?php

$this->load->model("tags_model");
echo $this->tags_model->tweet($_GET['tweetID']);
