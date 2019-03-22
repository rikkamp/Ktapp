import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import Edit from './Edit';

export default class Index extends Component {
	constructor(props) {
		super(props)
		this.state = {
			data: false,
			date: new Date().toISOString().split('T')[0],
			items: [],
			editItem: []
		}
	}
	componentDidMount() {
		this.getData(this.state.date);
	}

	render() {

		this.update = e => {
			let datum = new Date(e.target.value),
			month = '' + (datum.getMonth() + 1),
			day = '' + datum.getDate(),
			year = datum.getFullYear();
			if (month.length < 2) month = '0' + month;
			if (day.length < 2) day = '0' + day;
			let date = [year, month, day].join('-');
			this.setState({
				date: date
			});
		}

		this.getData = (date) => {
			axios.request({
				url: '/gegevensGet',
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

		this.changeHandler = event => {
			let editItem = this.state.editItem;
			let items = this.state.items;
			editItem[event.target.name] = event.target.value;
			this.setState({
				editItem: editItem
			});
		}

		this.edit = async (item, index) => {
			await this.setState({
				editItem: item,
				editKey: index
			});
		}

		this.fetchEdit = async () => {
			
			console.log(this.state.editItem)
			this.setState({editItem: []})
		}

		return (
			<>
				<div className='crud__box'>
					<div className='date'>
						<input className='date__picker' type='date' value={this.state.date !== new Date().toISOString().split('T')[0] ? this.state.date : new Date().toISOString().substr(0, 10)} onChange={(e) => this.update(e)}/>
						<button className='button button__send' onClick={() => {this.setState({date: document.querySelector('.date__picker').value}), this.getData(this.state.date)}}>ophalen</button>
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
								{item.gegevens_id === null ? (<button className='button'> leeg </button>) : (<button className='button item__button'> verwijder </button>)}
							</div>
						))
					}
					</div>
				</div>
				{this.state.editItem.gegevens_id !== undefined && 
					<Edit handler={() => this.fetchEdit()}close={() => {this.setState({editItem: []})}} changeHandler={(e) => this.changeHandler(e)} editLoc={(e) => this.editLoc(e)} editAan={(e) => this.editAan(e)} editVer={(e) => this.editVer(e)} item={this.state.editItem} />
				}
			</>
		)
	}
}

if (document.querySelector('.crud')) {
	ReactDOM.render(<Index />, document.querySelector('.crud'));
}
