import React, { Component } from 'react';
import Popup from './Popup';

export default class Edit extends Component {
	constructor(props) {
		super(props)
		this.state = {
			aankomst: '00:00',
			vertrek: '00:00'
		}
	}

	componentDidMount() {
		this.setState({
			aankomst: this.getTime(),
			vertrek: this.getTime()
		})
	}
	render() {
		this.getTime = () => {
			let date = new Date();
			let hours = date.getHours();
			let minutes = date.getMinutes();
			if(hours < 10) {
				hours = '0' + hours;
			}
			return hours + ':' + minutes
		}
		this.changeAankomst = e => {
			this.setState({
				aankomst: e.target.value
			})
			document.querySelector('input[name=gegevens_aankomst]').value = e.target.value;
		}
		this.changeVertrek = e => {
			this.setState({
				vertrek: e.target.value
			})
			document.querySelector('input[name=gegevens_vertrek]').value = e.target.value;
		}
		return (
			<Popup className='popup__box edit'>
				<div>
					<div className='popup__title'>
						<h2>{this.props.item !== undefined ? ('Aanpassen') : ('Nieuw')}<span onClick={this.props.close} ><img className='times' onClick={this.props.close} src='../KTapp/images/times-solid.svg' /></span></h2>
					</div>
					<div className='edit__content'>
						<span className='edit__label'>
						<label>KM</label><input name='gegevens_km' type='text' placeholder={this.props.item !== undefined ? this.props.item.gegevens_km : 'Km'} className='edit__text' onChange={this.props.changeHandler}></input>
						</span>
						<span className='edit__label'>
						<label>Locatie</label><input name='gegevens_locatie' type='text' placeholder={this.props.item !== undefined ? this.props.item.gegevens_locatie : 'Locatie'} className='edit__text edit__text--long' onChange={this.props.changeHandler} ></input>
						</span>
						<span className='edit__label'>
						<label>Aankomst</label><input className='time' value={this.state.aankomst} onClick={this.changeAankomst} onChange={(e) => this.changeAankomst(e)} type='time'></input><input name='gegevens_aankomst' type='text' placeholder={this.props.item !== undefined ? this.props.item.gegevens_aankomst : 'Aankomst'} className='edit__text edit__text--long' onChange={this.props.changeHandler} ></input>
						</span>
						<span className='edit__label'>
						<label>Vertrek</label><input className='time' value={this.state.vertrek} onClick={this.changeVertrek} onChange={(e) => this.changeVertrek(e)} type='time'></input><input name='gegevens_vertrek' type='text' placeholder={this.props.item !== undefined ? this.props.item.gegevens_vertrek : 'Vertrek'} className='edit__text edit__text--long' onChange={this.props.changeHandler}></input>
						</span>
						<span className='edit__label'>
						<label>No</label><input name='gegevens_no' type='text' placeholder={this.props.item !== undefined ? this.props.item.gegevens_no : 'No'} className='edit__text edit__text--long' onChange={this.props.changeHandler}></input>
						</span>
						<button onClick={this.props.handler} className='button button--normal'>{this.props.item !== undefined ? ('Aanpassen') : ('Nieuw')}</button>
					</div>
				</div>
			</Popup>
		)
	}
}
