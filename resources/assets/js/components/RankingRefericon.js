
import React from 'react';
import ReactDOM from 'react-dom';

import prizes from '../prizes';



 
export default class Ranking extends React.Component {

   constructor() {
        super(); 

        this.state = {
            ranking : []
        };

    }

  
    getRanking()
    {

        axios.get('https://api.eventjuicer.com/v1/services/refericon/78')

            .then(function (response) {

                if ("data" in response.data)
                {
                    this.setState({ranking: response.data.data});
                }
                
        }.bind(this))
        .catch(function (error) {
            console.log(error);
        });
    }

    renderPrizes(pos)
    {
        

        return (<ul> {

        prizes.map(function(prize, i){

            if(prize.min <= pos+1 && pos+1 <= prize.max)
            {
                return (<li key={i}>{prize.name}</li>);
            }

            return null;
            

        }) } </ul>);
    }

    componentWillMount()
    {
        
       this.getRanking();

    }


    render() {

        const {ranking} = this.state;

       // const rankingFiltered = ranking.filter((item)=> "name" in item);

        return (
            
            <div className="table-responsive">
            <table className="table table-striped">
              <thead>
                <tr>
                  <th>Miejsce</th>
                  <th>Wynik</th>

                  <th>Imię i nazwisko</th>
                  <th>Email</th>

                  <th>Telefon</th>
                
                  
                  <th>Świadczenia, które otrzymasz od Fundatorów nagród</th>
                </tr>
              </thead>

                <tbody>
                {ranking ? 

                    ranking.map(function(item,i)
                    {

                        return (

                <tr key={i}>
                  

                  <td className="text-center">{i+1}</td>
                  <td><strong>{item.points}</strong> punktów</td>
                  <td>{item.fname} {item.lname}</td>
                  <td>{item.email}</td>
                  <td>{item.phone}</td>
                  
                  <td>{

                    this.renderPrizes(i)

                  }</td>
                </tr> 
                )
                    }.bind(this)) : null

            
                }
               
                </tbody>
                </table>
                </div>
        );
    }
}




if (document.getElementById('ranking')) {
    ReactDOM.render(<Ranking />, document.getElementById('ranking'));
}
