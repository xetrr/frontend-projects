import React from "react";
import { Container, Col, Row } from "react-bootstrap";

export default function Navbar({ search }) {
  const changeSearch = (word) => {
    search(word);
  };

  return (
    <div className="nav-style w-100 ">
      <Container>
        <Row className="d-flex justify-content-between">
          <Col xs="2" lg="2">
            <a href="/" className="logo-text">
              Watch
            </a>
          </Col>
          <Col xs="6" lg="6" className="d-flex align-items-center">
            <div className="search w-100">
              <input
                onChange={(e) => changeSearch(e.target.value)}
                type="text"
                className="form-control"
                placeholder="Search..."
              />
            </div>
          </Col>
        </Row>
      </Container>
    </div>
  );
}
