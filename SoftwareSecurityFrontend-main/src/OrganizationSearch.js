import Header from './Header'
import React, { useState, useEffect } from 'react'
import { Table } from 'react-bootstrap'
import { fetchData } from './api'

function SearchOrganization() {

    const [data, setData] = useState([]);


    async function search(key) {

        const response = await fetchData("http://127.0.0.1:8081/api/organizations/", key)

        setData(response)

    }
    const ticketSubject = data.length > 0 ? data[0] : []
    const usersName = data.length > 1 ? data[1] : []
    

    return (
        <div>
            <Header />
            <div className="">
                <h1>Search Organizationss</h1>
                <br />
                <input type="text" onChange={(e) => search(e.target.value)} className="form-control" placeholder="Search" />

                <Table>

                    {ticketSubject && <tr>
                        <td >
                            <p style={{ fontWeight: "bold" }}>Ticket Subject</p>
                        </td>
                        {ticketSubject.map((item) =>
                            <td>{item}</td>
                        )}
                    </tr>
                    }

                    {usersName && <tr>
                        <td >
                            <p style={{ fontWeight: "bold" }}>User Name</p>
                        </td>
                        {usersName.map((item) =>
                            <td>{item}</td>
                        )}
                    </tr>
                    }



                </Table>

            </div>
        </div>
    )
}

export default SearchOrganization