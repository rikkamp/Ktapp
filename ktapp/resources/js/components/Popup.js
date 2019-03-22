import React, { Component, Children } from 'react';

const Popup = (props) => {
	return (
		<div className={props.className ? 'popup ' + props.className : 'popup'}>
			{props.children}
		</div>
	)
}

export default Popup;
