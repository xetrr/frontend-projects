import React, { useState, useEffect } from "react";
import { Col, Row } from "react-bootstrap";
import { Link, useParams } from "react-router-dom";
import axios from "axios";

function MoviePage({api_key}) {

    const param = useParams()
    const [movie, setmovie] = useState([])
    const movieDetails =async()=>{
        const res= await axios.get(`https://api.themoviedb.org/3/movie/${param.id}?api_key=${api_key}&language=en-US`)
        setmovie(res.data);
        console.log(res.data);
      }
      useEffect(()=>{
        movieDetails()        
      })
   
  return (
    <div>
      <Row className="justify-content-center">
        <Col md="12" xs="12" sm="12" className="mt-4 ">
          <div className="card-detalis  d-flex align-items-center ">
            <img
              className="img-movie w-30"
              src={`https://image.tmdb.org/t/p/w500/${movie.poster_path}`}
            />
            <div className="justify-content-center text-center  mx-auto">
              <p className="card-text-details border-bottom">{movie.original_title}</p>
              <p className="card-text-details border-bottom">{movie.release_date} </p>
              <p className="card-text-details border-bottom"> {movie.vote_average}</p>
              <p className="card-text-details border-bottom">{movie.vote_count}</p>
            </div>
          </div>
        </Col>
      </Row>

      <Row className="justify-content-center">
        <Col md="12" xs="12" sm="12" className="mt-1 ">
          <div className="card-story  d-flex flex-column align-items-start">
            <div className="text-end px-4  py-2">
              <p className="card-text-title border-bottom story">story</p>
            </div>
            <div className="text-start px-4">
              <p className="card-text-story">{movie.overview ? movie.overview : 'no data'}</p>
            </div>
          </div>
        </Col>
      </Row>
      <Row className="justify-content-center">
        <Col
          md="10"
          xs="12"
          sm="12"
          className="mt-2 d-flex justify-content-center "
        >
          <Link to="/">
            <button
              style={{ backgroundColor: "#038157", border: "none" }}
              className="btn btn-primary mx-2"
            >
              Home
            </button>
          </Link>
          <a href={movie.homepage}>
            <button
              style={{ backgroundColor: "#038157", border: "none" }}
              className="btn btn-primary"
            >
              Watch the Movie
            </button>
          </a>
        </Col>
      </Row>
    </div>
  );
}


export default MoviePage;
