import React from "react";
import { Col } from "react-bootstrap";
import { Link } from "react-router-dom";

export default function CardMovie({ movie }) {
  return (
    <Col xs="6" sm="6" md="4" lg="3" className="my-1">
      <Link to={`/Movie/${movie.id}`}>
        <div className="card">
          <img
            src={
              movie.poster_path === null
                ? "avatar.png"
                : `https://image.tmdb.org/t/p/original/${movie.poster_path}`
            }
            className="card__image"
          />
          <div className="card__overlay">
            <div className="overlay__text text-center w-100 p-2">
              <p className="movieTitle">{movie.original_title}</p>
              <p>{movie.release_date}</p>
              <p className={movie.vote_average > 5 ? "goodRate" : "badRate"}>
                {movie.vote_average}
              </p>
              <p>{movie.vote_count}</p>
            </div>
          </div>
        </div>
      </Link>
    </Col>
  );
}
