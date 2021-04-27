import Header from './Header'
import React, { useState, useEffect } from 'react'
import { Table } from 'react-bootstrap'
import { fetchData } from './api'


function SearchOrganization() {

    const [data, setData] = useState([]);

    async function search(key) {

        const response = await fetchData("http://127.0.0.1:8081/api/organization/", key)

        setData(response)

    }

    const tickets = data.length > 0 ? data[0] : []
    const users = data.length > 1 ? data[1] : []

    return (
        <div>
            <Header />
            <div className="">
                <h1>Search URL by Organization IDss</h1>
                <br />
                <input type="text" onChange={(e) => search(e.target.value)} className="form-control" placeholder="Search" />


                <Table>

                    {tickets && <tr>
                        <td >
                            <p style={{ fontWeight: "bold" }}>Ticket Url</p>
                        </td>
                        {tickets.map((item) =>
                            <td>{item}</td>
                        )}
                    </tr>
                    }

                    {users && <tr>
                        <td >
                            <p style={{ fontWeight: "bold" }}>User Url</p>
                        </td>
                        {users.map((item) =>
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