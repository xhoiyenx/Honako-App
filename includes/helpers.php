<?php
function app( $make = null )
{
  global $app;
  if ( ! empty( $make ) ) {
    return $app->make($make);
  }
  else {
    return $app;
  }
}