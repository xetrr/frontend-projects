import React from "react";
import ReactPaginate from "react-paginate";

function Pagentaion({ getMoviesByPageNumber }) {
  const handlePageClick = (data) => {
    getMoviesByPageNumber(data.selected + 1);
  };
  const pageCount = 500;
  return (
    <ReactPaginate
      breakLabel="..."
      nextLabel="next >"
      onPageChange={handlePageClick}
      pageRangeDisplayed={2}
      marginPagesDisplayed={2}
      pageCount={pageCount}
      previousLabel="< previous"
      renderOnZeroPageCount={null}
      containerClassName={"pagination justify-content-center mt-3"}
      activeClassName={"active"}
      pageClassName={"page-item"}
      pageLinkClassName={"page-link"}
      activeLinkClassName={"page-link"}
      previousClassName={"page-item ms-1"}
      previousLinkClassName={"page-link"}
      nextClassName={"page-item me-1"}
      nextLinkClassName={"page-link"}
      breakClassName={"page-item"}
      breakLinkClassName={"page-link"}
    />
  );
}

export default Pagentaion;
