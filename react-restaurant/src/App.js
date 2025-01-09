import { useState } from "react";
import { Container } from "react-bootstrap";
import "./App.css";
import Category from "./componantes/Category";
import ItemsList from "./componantes/ItemsList";
import MainpageHeader from "./componantes/MainpageHeader";
import Navbar from "./componantes/Navbar_rest";
import { items } from "./data";

export default function App() {
  const [itemsdata, setItemsdata] = useState(items);
  const allCat = [...new Set(items.map((i) => i.category))];
  console.log(allCat);
  //filter by category
  const filterByCategroy = (cat) => {
    if (cat === "الكل") {
      setItemsdata(items);
    } else {
      const newArr = items.filter((item) => item.category === cat);
      setItemsdata(newArr);
    }
  };

  //filter by search
  const filterBySearch = (word) => {
    if (word !== "") {
      const newArr = items.filter((item) => item.title === word);
      setItemsdata(newArr);
    }
  };
  return (
    <div className="font">
      <Navbar filterBySearch={filterBySearch} />
      <Container>
        <MainpageHeader />
        <Category filterByCategroy={filterByCategroy} allCat={allCat} />
        <ItemsList itemsdata={itemsdata} />
      </Container>
    </div>
  );
}
