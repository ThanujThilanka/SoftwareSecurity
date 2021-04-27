import Header from './Header'
import React, { useState, useEffect } from 'react'
import { Table } from 'react-bootstrap'
import { fetchData } from './api'

function SearchOrganization() {

    const [data, setData] = useState([]);

    async function search(key) {

        // console.warn(key)

        const response = await fetchData("http://127.0.0.1:8081/api/user/", key)

        setData(response)
    }

    const name = data.length > 0 ? data : []

    return (
        <div>
            <Header />
            <div className="">
                <h1>User Search by Organization IDss</h1>
                <br />
                <input type="text" onChange={(e) => search(e.target.value)} className="form-control" placeholder="Search" />

                <Table>

                    {name && <tr>
                        <td >
                            <p style={{ fontWeight: "bold" }}>Assignee Name</p>
                        </td>
                        {name.map((item) =>
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