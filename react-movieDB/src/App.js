import { Container } from 'react-bootstrap';
import './App.css';
import Navbar from './componantes/Navbar';
import MoviesList from './componantes/MoviesList';
import MoviePage from './componantes/MoviePage';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import axios from 'axios';
import { useState,useEffect } from 'react';

function App() {
  const api_key= 'ac99df60452891ece24b8bda8ca77b80'
  const [movies, setmovies] = useState({})
  //const [pageCount, setpageCount] = useState(0)
//##################get All Moveis//##################
  const getAllMoveis =async()=>{
    const res= await axios.get(`https://api.themoviedb.org/3/movie/popular?api_key=${api_key}&language=en-US&page=1`)
    setmovies(res.data.results);
    // setpageCount(res.data.total_pages)
    // console.log(res.data.total_results);
    // console.log(res.data.total_pages);
  }
  useEffect(()=>{
    getAllMoveis()
    
  },[])
//#################search movies########################
  const search = async(word)=> {
    if(word === ''){
      getAllMoveis()    
    }else {const res= await axios.get(`https://api.themoviedb.org/3/search/movie?api_key=${api_key}&query=${word}&language=en-US`)
    setmovies(res.data.results)
    //setpageCount(res.data.total_pages)
  }
  }
  //####################get Movies By Page Number###############
  const getMoviesByPageNumber = async(num)=> {
     {const res= await axios.get(`https://api.themoviedb.org/3/movie/popular?api_key=${api_key}&language=en-US&page=${num}`)
    setmovies(res.data.results)
    //setpageCount(res.data.total_pages)
  }
  }

  return (
   <div className='font color-body'>
    <Navbar search={search}/>
    <Container>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<MoviesList  movies={movies} getMoviesByPageNumber={getMoviesByPageNumber} />}/>
          <Route path='/Movie/:id' element={<MoviePage api_key={api_key}/>}/>
        </Routes>
      </BrowserRouter>    
    </Container>
   </div>
  );
}

export default App;
