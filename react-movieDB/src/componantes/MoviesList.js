import React from 'react';
import { Row } from 'react-bootstrap';
import CardMovie from './CardMovie';
import Pagentaion from './Pagentaion';



export default function MoviesList({movies , getMoviesByPageNumber }) {
  
  return (
    <Row className='mt-3 py-5'>
      {
        movies.length >=1 ?
        (movies.map((movie)=>{return( <CardMovie  key={movie.id} movie={movie}/>)})) 
        :<h2 className='text-center p-5' style={{color:'#fff'}}>...loading</h2>
      }
    <Pagentaion getMoviesByPageNumber={getMoviesByPageNumber}  />
    </Row>
  )
}
