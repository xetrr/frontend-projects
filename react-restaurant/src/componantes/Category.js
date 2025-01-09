import React from 'react'
import { Row,Col } from 'react-bootstrap';
import Flip from 'react-reveal/Flip';


export default function Category({filterByCategroy,allCat}) {

    const onFilter = (cat)=> {
        filterByCategroy(cat)
    }
    
  return (
    <Row className='my-2 mb-5'>
        
      <Col className='d-flex justify-content-center'>
          <div>
            <Flip left>
                  <button onClick={()=> onFilter('الكل')}className='btnnn mx-2' style={{ border: '1px solid #b45b35'}}>الكل</button></Flip> 
                  <Flip left>
                   {
                    allCat.map((c)=>{
                      return(
                      <button onClick={()=> onFilter(c)} className='btnnn mx-2' style={{ border: '1px solid #b45b35'}}>{c}</button>
                      )
                    })
                  }
               </Flip>
          </div>   
        
      </Col>
    </Row>
  )
}
