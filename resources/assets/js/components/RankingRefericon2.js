
import React from 'react';
import ReactDOM from 'react-dom';
import {CSVLink, CSVDownload} from 'react-csv';


import prizes from '../prizes';
import DATA from './refericonWinners';


 
export default class RankingRefericon2 extends React.Component {

   constructor() {
        super(); 

        this.state = {
            ranking : []
        };

    }



    assignPrizes(pos)
    {
        let assignedPrizes = [];

        prizes.forEach(function(prize, i){

            if(prize.min <= pos+1 && pos+1 <= prize.max)
            {
              
                assignedPrizes.push(prize.tag);
            }
        });

        return assignedPrizes.join(",");
           
    }


    componentWillMount()
    {


       const newData = DATA.data.map(function(item, i)
       {

          item["link"] = `https://targiehandlu.pl/visitor-secret-profile-abc/${item.id}`

          return Object.assign({}, {place : i+1}, item, {prizes : this.assignPrizes(i)});

       }.bind(this));

       this.setState({ranking : newData});

      console.log(newData);

    }


    render() {

      const {ranking} = this.state;

       
      return(

       <CSVLink data={ranking}>Download me</CSVLink>

      );
    }
}



if (document.getElementById('ranking2')) {
    ReactDOM.render(<RankingRefericon2 />, document.getElementById('ranking2'));
}



 