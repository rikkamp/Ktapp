import React, { Component } from 'react'

export default class Mail extends Component {
	render() {
		return (
		<div className='popup__box popup popup--warning'>
			<p className='popup__text'>
				{this.props.children}
				<button className='button button--normal' onClick={this.props.close}>Oke</button>
			</p>
		</div>
		)
	}
}
