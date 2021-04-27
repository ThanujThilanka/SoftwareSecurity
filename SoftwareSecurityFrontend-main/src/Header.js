import { Navbar, Nav, NavDropdown } from 'react-bootstrap'
import { Link, useHistory } from 'react-router-dom'
function Header() {
    let user = JSON.parse(localStorage.getItem('user-info'))
    const history = useHistory();
    function logOut() {
        localStorage.clear();
        history.push('/register')
    }
    return (
        <div>
            <Navbar>
                <Navbar.Brand href="#home">SS Assignemnt</Navbar.Brand>
                <Nav className="mr-auto navbar_warapper">

                    {
                        localStorage.getItem('user-info') ?
                            <>
                                <Link to="/searchOrganization">Search Organization</Link>
                                <br></br>
                                <Link to="/OrganizationSearch">Organization Search</Link>
                                <Link to="/UserSearch">User Search</Link>
                                {/* <Link to="/SearchUser">Search User</Link>
                                <Link to="/TicketSearch">Search Tickets</Link>
                                <Link to="/SearchTicket">Tickets Search</Link> */}

                            </>
                            :
                            <>
                                <Link to="/login">Login</Link>
                                <Link to="/register">Register</Link>
                            </>
                    }


                </Nav>
                <Nav>
                    <NavDropdown title={user && user.name}></NavDropdown>
                    <NavDropdown.Item onClick={logOut}>Logout</NavDropdown.Item>
                </Nav>
            </Navbar>
        </div>
    )
}

export default Header