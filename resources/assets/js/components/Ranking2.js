
import React from 'react';
import ReactDOM from 'react-dom';

import GA from './ga';


const prizes = [

  {"name" : "Wywiad video", "min" : 1, "max" : 3},
  {"name" : "Prawo do dystrybucji ulotek", "min": 1, "max": 20},
  {"name" : "Aplikacja do skanowania zwiedzających", "min": 1, "max": 50}

];
 
export default class Ranking extends React.Component {

   constructor() {
        super(); 

        this.state = {
            ranking : []
        };

    }

  
    getRanking()
    {


      this.setState({ranking: GA.data});


        // axios.get('https://api.eventjuicer.com/v1/public/hosts/targiehandlu.pl/partner-performance?search=partner_&role=company')

        //     .then(function (response) {

        //         if ("data" in response.data)
        //         {
        //             this.setState({ranking: response.data.data});
        //         }
                
        // }.bind(this))
        // .catch(function (error) {
        //     console.log(error);
        // });
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

        const rankingFiltered = ranking.filter((item)=> "name" in item);

        return (
            
            <div className="table-responsive">
            <table className="table table-striped">
              <thead>
                <tr>
                  <th>Miejsce</th>
                  <th>Nazwa firmy</th>
                  <th>Punktów</th>
                <th>Świadczenia, które otrzymasz od Organizatora</th>
                </tr>
              </thead>

                <tbody>
                {rankingFiltered ? 

                    rankingFiltered.map(function(item,i)
                    {

                        return (

                <tr key={i}>
                 <td>{i+1}</td>
                  <td>{item.name}</td>
                  <td>{item.sessions}</td>
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
