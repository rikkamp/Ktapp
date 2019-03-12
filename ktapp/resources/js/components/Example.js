import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Example extends Component {
    constructor(props) {
        super(props);

        this.state = {
            token: ''
        };
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

        return (
            <p>
                test
            </p>
        );
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
