<?php
function template( $path = null )
{
	if (empty($path)) {
		return app('template');
	}
}