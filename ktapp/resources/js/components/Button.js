import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Button extends Component {
	render() {
		return (
			<span {...this.props}>
				{this.props.children}
			</span>
		)
	}
}
