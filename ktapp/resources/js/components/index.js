import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Index extends Component {
	constructor(props) {
		super(props)
		this.state = {
			id: 0
		}
	}
	componentDidMount() {
		let tokens = document.getElementsByName('id');
		for(let token in tokens) {
			token = parseInt(token);
			if(!isNaN(token)) {
				this.setState({token: tokens[token].getAttribute('content')});
			}
		}
	}
	render() {
		return (
			<div>
				{this.state.token}
			</div>
		)
	}
}

if (document.querySelector('.crud')) {
    ReactDOM.render(<Index />, document.querySelector('.crud'));
}

