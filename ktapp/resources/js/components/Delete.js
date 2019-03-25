import React, { Component } from 'react'

export default class Delete extends Component {
  render() {
	return (
	<div className='popup__box popup popup--warning'>
		<p className='popup__text'>Weet je zeker dat je rit van <span className='popup__text popup__text--time'>{this.props.item.gegevens_aankomst && this.props.item.gegevens_aankomst}</span> tot <span className='popup__text popup__text--time'>{this.props.item.gegevens_vertrek && this.props.item.gegevens_vertrek}</span> wilt verwijderen</p>
		<div className='popup__button'>
			<button className='button button--normal' onClick={this.props.close}>nee</button>
			<button className='button button--normal' onClick={this.props.handler}>ja</button>
		</div>
	</div>
	)
	}
}
