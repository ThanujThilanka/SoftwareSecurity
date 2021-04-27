import './App.css';
import { BrowserRouter, Route } from 'react-router-dom'
import Login from './Login'
import Register from './Register'
import Protected from './Protected'
import SearchTicket from './SearchTicket'
import SearchOrganization from './SearchOrganization'
import OrganizationSearch from './OrganizationSearch'
import Ticket from './Ticket'
import Organization from './Organization'
import User from './User'
import UserSearch from './UserSearch'
import SearchUser from './SearchUser'
import TicketSearch from './TicketSearch'




function App() {
  return (
    <div className="App">
      <BrowserRouter>
        {/* <h1>SS Assignemnt</h1> */}
        <Route path="/login">
          <Login />
        </Route>
        <Route path="/register">
          <Register />
        </Route>

        {/* <Route path="/SearchTicket">
          <Protected Cmp={SearchTicket} />
        </Route> */}


        <Route path="/searchOrganization">
          <Protected Cmp={SearchOrganization} />
        </Route>


        <Route path="/OrganizationSearch">
          <Protected Cmp={OrganizationSearch} />
        </Route>

        {/* <Route path="/ticket">
          <Protected Cmp={Ticket} />
        </Route> */}

        {/* <Route path="/Organization">
          <Protected Cmp={Organization} />
        </Route>

        <Route path="/User">
          <Protected Cmp={User} />
        </Route> */}

        <Route path="/UserSearch">
          <Protected Cmp={UserSearch} />
        </Route>

        {/* <Route path="/SearchUser">
          <Protected Cmp={SearchUser} />
        </Route>

        <Route path="/TicketSearch">
          <Protected Cmp={TicketSearch} />
        </Route> */}

      </BrowserRouter>
    </div>
  );
}

export default App;
