import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Login extends Component {
	constructor(props) {
		super(props);
		this.state = {
			username: '',
			password: ''
		}
	}
	
	componentWillMount() {
		let tokens = document.getElementsByName('csrf-token');
		for(let token in tokens) {
			token = parseInt(token);
			if(!isNaN(token)) {
				if(tokens[token].getAttribute('name') === 'csrf-token') {
					this.setState({
						token: tokens[token].getAttribute('content')
					})
				}
			}
		}
	}
	
	render() {

		this.updateUser = e => {
			this.setState({
				username: e.target.value
			});
		}

		this.updatePass = e => {
			this.setState({
				password: e.target.value
			});
		}

		this.login = () => {
			// fetch()
		}

		return (
			<div className='login__container'>
				<div className='login__form'>
				<p className='login__title'>Welkom bij de transport app</p>
				<label className='login__input--label'>Gebruikersnaam:</label>
				<input className='login__input' type='text' onChange={this.updateUser} value={this.state.username} />
				<label className='login__input--label'>Wachtwoord:</label>
				<input type='password' className='login__input' onChange={this.updatePass} value={this.state.password} />
				<button type='button' onClick={this.login} > Inloggen </button>
				</div>
			</div>
		)
	}
}

if (document.querySelector('.login')) {
    ReactDOM.render(<Login />, document.querySelector('.login'));
}
