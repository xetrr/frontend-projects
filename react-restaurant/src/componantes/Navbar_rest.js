import React, { useState } from "react";

import { Row } from "react-bootstrap";
import Container from "react-bootstrap/Container";
import Form from "react-bootstrap/Form";
import Navbar from "react-bootstrap/Navbar";

export default function Navbar_rest({ filterBySearch }) {
  const [SearchValue, setSearchValue] = useState("");
  const onSearch = (e) => {
    e.preventDefault();
    filterBySearch(SearchValue);
    setSearchValue("");
  };
  return (
    <div>
      <Row>
        <Navbar expand="lg" variant="dark" bg="dark">
          <Container>
            <Navbar.Brand href="#" className="brand-color font">
              <div className="brand-color">مطعم</div>
            </Navbar.Brand>

            <Form className="d-flex">
              <Form.Control
                type="text"
                placeholder="ابحث هنا..."
                className="me-2"
                onChange={(e) => setSearchValue(e.target.value)}
                value={SearchValue}
              />
              <button onClick={(e) => onSearch(e)} className="brand-color me-2">
                ابحث{" "}
              </button>
            </Form>
          </Container>
        </Navbar>
      </Row>
    </div>
  );
}
