import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import Edit from './Edit';
import Delete from './Delete';
import Mail from './Mail';

export default class Index extends Component {
	constructor(props) {
		super(props)
		this.state = {
			data: false,
			date: new Date().toISOString().split('T')[0],
			weekNo: 0,
			items: [],
			editItem: [],
			mail: false
		}
	}

	// set date, week and year by starting
	// start
	// calls getData , getWeek

	componentDidMount() {
		this.getData(this.state.date);
		this.setState({
			weekNo: this.getWeek(new Date()),
			day_id: new Date().getDay(),
			year: new Date().getFullYear()
		});
	}

	render() {

		//will get the week number base on input date
		// getweek
		// calls Null

		this.getWeek = datum => {
			datum = new Date(Date.UTC(datum.getFullYear(), datum.getMonth(), datum.getDate()));
			datum.setUTCDate(datum.getUTCDate() + 4 - (datum.getUTCDay()||7));
			let yearStart = new Date(Date.UTC(datum.getUTCFullYear(),0,1));
			let weekNo = Math.ceil(( ( (datum - yearStart) / 86400000) + 1)/7);
			return weekNo;
		}

		// Will update the date , weekNo day_id and the year
		// update
		// calls getWeek

		this.update = e => {
			let datum = new Date(e.target.value),
			month = '' + (datum.getMonth() + 1),
			day = '' + datum.getDate(),
			year = datum.getFullYear();
			if (month.length < 2) month = '0' + month;
			if (day.length < 2) day = '0' + day;
			let date = [year, month, day].join('-');
			let weekNo = this.getWeek(datum);
			let day_id = datum.getDay();
			let jaar = new Date(e.target.value).getFullYear();
			this.setState({
				date: date,
				weekNo: weekNo,
				day_id: day_id,
				year: jaar
			});
		}

		// This function gets the data for the crud. This uses axios(required for laravel) fetch
		// getData
		// calls Null

		this.getData = (date) => {
			axios.request({
				url: document.getElementById('gegevensGet').content,
				method: 'post',
				data: {
					'gegevens_datum': date
				}
			}).then(response => {
				if(response.data !== undefined) {
					if(response.data.result) {
						if(response.data.items !== undefined && response.data.items.length >= 1) {
							this.setState({
								data: response.data.result,
								items: response.data.items
							});
						} else {
							this.setState({
								data: false,
								items: []
							});
						}
					}
				}
			});
		}

		// This handler will change the data of the input. When its empty it changes it back to normal
		// changeHandler
		// calls Null

		this.changeHandler = event => {
			let editItem = this.state.editItem;
			if(event.target.value !== '') {
				editItem[event.target.name] = event.target.value;
			} else {
				editItem[event.target.name] = null;
			}
			this.setState({
				editItem: editItem
			});
		}

		// edit will get the item and sets the editItem state to it. This is so the popup can open and knows which data to use.
		// edit
		// calls Null

		this.edit = (item, index) => {
			if(item.length === 0 && index === null) {
				let editItem = {'gegevens_km': null, 'gegevens_locatie': null, 'gegevens_aankomst': null, 'gegevens_vertrek': null, 'gegevens_no': null};
				this.setState({
					editItem: editItem
				})
			} else {
				this.setState({
					editItem: item,
					editKey: index
				});
			}
		}

		// fetchEdit will call to the database and usally returns to the data. In thit case it returns it before the fetch. How ? IDFK
		// fetchEdit
		// calls Null

		this.fetchEdit = async () => {
			axios.request({
				url: document.getElementById('gegevensPost').content,
				method: 'post',
				data: this.state.editItem
			});
			this.setState({editItem: []})
		}

		// delete will set a delete item and toggles the popup
		// delete
		// class Null

		this.delete = (i, item) => {
			this.setState({
				delItem: item,
				deletePopup: !this.state.deletePopup
			});
		}

		// fetch delete will get the right data of the state and send it to the controller.
		// fetchDelete
		// calls Null

		this.fetchDelete = () => {
			axios.request({
				url: document.getElementById('gegevensDelete').content,
				method: 'post',
				data: {
					'gegevens_id': this.state.delItem.gegevens_id
				}}).then(response => {
				if(response.data !== undefined) {
					if(response.data.result) {
						this.getData(this.state.date);
						this.toggleDelete();
					}
				}
			});
		}

		// this toggles the delete popup
		// toggleDelete
		// calls Null
		
		this.toggleDelete = () => {
			this.setState({
				deletePopup: !this.state.deletePopup
			});
		}
		
		// this toggles the add popup
		// toggleAdd
		// calls Null

		this.toggleAdd = () => {
			this.setState({
				addPopup: !this.state.addPopup
			})
		}

		// this function will add a new item to the crud. This gets done by a popup. This handels the final fetch
		// add
		// calls Null

		this.add = () => {
			axios.request({
				url: document.getElementById('gegevensPut').content,
				method: 'put',
				data: {
					'gegevens_datum': this.state.date,
					'gegevens_week': this.state.weekNo,
					'days_id': this.state.day_id,
					'gegevens_jaar': this.state.year,
					...this.state.editItem
			}}).then(response => {
			if(response.data !== undefined) {
				if(response.data.result) {
					let items = this.state.items;
					items.push(response.data.item);
					this.setState({
						items: items
					});
					this.toggleAdd();
				}
			}
				
			});
		}

		this.toggleMail = () => {
			this.setState({
				mail: !this.state.mail
			});
		}

		this.sendMail = () => {
			this.setState({
				mailMsg: 'De mail is bezig met versturen even geduld aub',
				mail: true
			});
			axios.request({url: document.getElementById('gegevensPdf').content,
				method: 'post',
				data: {
					'gegevens_week': this.state.weekNo
				}
			}).then(
				response => {
					if(response.status > 199 && response.status < 300) {
						this.setState({mailMsg: 'Mail verstuurd.'})
					} else {
						if(response.statusText !== undefined) {
							this.setState({mailMsg: response.statusText})
						} else {
							this.setState({mailMsg: 'er ging iets mis probeer het later opnieuw.'})
						}
					}
				} 
			)
		}

		return (
			<>
				<div className='crud__box'>
					<div className='date'>
						<input className='date__picker' type='date' value={this.state.date !== new Date().toISOString().split('T')[0] ? this.state.date : new Date().toISOString().substr(0, 10)} onChange={(e) => this.update(e)}/>
						<button className='button button__send' onClick={() => {this.setState({date: document.querySelector('.date__picker').value}), this.getData(this.state.date)}}>ophalen</button>
						<button className='button' onClick={() => {this.toggleAdd(), this.edit([], null)}}>Nieuw</button>
					</div>
					<div className='crud__container'>
						<div className='item'>
							<p className='item__name--title'>Km</p>
							<p className='item__name--title'>Locatie</p>
							<p className='item__name--title'>Aankomst</p>
							<p className='item__name--title'>Vertrek</p>
							<p className='item__name--title'>No</p>
						</div>
					{this.state.data &&
						this.state.items.map((item, i) => (
							<div key={i} className='item'>
								{item.gegevens_km === null ? (<p className='item__name--empty'> leeg </p>) : (<p className='item__name'> {item.gegevens_km}</p>)}
								{item.gegevens_locatie === null ? (<p className='item__name--empty'> leeg </p>) : (<p className='item__name'> {item.gegevens_locatie}</p>)}
								{item.gegevens_aankomst === null ? (<p className='item__name--empty'> leeg </p>) : (<p className='item__name'> {item.gegevens_aankomst}</p>)}
								{item.gegevens_vertrek === null ? (<p className='item__name--empty'> leeg </p>) : (<p className='item__name'> {item.gegevens_vertrek}</p>)}
								{item.gegevens_no === null ? (<p className='item__name--empty'> leeg </p>) : (<p className='item__name'> {item.gegevens_no}</p>)}
								{item.gegevens_id === null ? (<button className='button'> leeg </button>) : (<button onClick={() => this.edit(item, i)} className='button item__button'> edit </button>)}
								{item.gegevens_id === null ? (<button className='button'> leeg </button>) : (<button onClick={() => this.delete(i, item)} className='button item__button'> verwijder </button>)}
							</div>
						))
					}
					</div>
					<button className='button button--down button--normal' onClick={() => this.sendMail()} >PDF mailen</button>
				</div>
				{this.state.editItem.gegevens_id !== undefined && 
					<Edit handler={() => this.fetchEdit()}close={() => {this.setState({editItem: []})}} changeHandler={(e) => this.changeHandler(e)} item={this.state.editItem} />
				}
				{this.state.addPopup &&
				<Edit handler={() => this.add() } close={this.toggleAdd} changeHandler={(e) => this.changeHandler(e)} />
				}
				{this.state.deletePopup && 
				<Delete handler={() => this.fetchDelete()} item={this.state.delItem} close={this.toggleDelete} />
				}
				{
					this.state.mail &&
					<Mail close={this.toggleMail}>{this.state.mailMsg}</Mail>
				}
			</>
		)
	}
}

if (document.querySelector('.crud')) {
	ReactDOM.render(<Index />, document.querySelector('.crud'));
}
