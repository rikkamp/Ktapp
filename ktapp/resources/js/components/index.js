import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Index extends Component {
	render() {
		return (
			<div>

			</div>
		)
	}
}

if (document.querySelector('.main')) {
    ReactDOM.render(<Index />, document.querySelector('.main'));
}

