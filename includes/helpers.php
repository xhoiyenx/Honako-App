<?php
function template( $path = null )
{
	if (empty($path)) {
		return app('template');
	}
}

function twig( $path = null )
{
	if (empty($path)) {
		return app('twig');
	}
}

function settings( $foo )
{
	return '';
}