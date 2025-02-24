import { useEffect, useState } from "react";
import axios from "axios";
import "./App.css";
import Table from "@mui/material/Table";
import TableBody from "@mui/material/TableBody";
import TableCell from "@mui/material/TableCell";
import TableContainer from "@mui/material/TableContainer";
import TableHead from "@mui/material/TableHead";
import TableRow from "@mui/material/TableRow";
import Paper from "@mui/material/Paper";
import { Box, CircularProgress } from "@mui/material";
import UserForm from "./UserForm";

function Profile() {
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState();
  const [refresh, setRefresh] = useState(false);

  useEffect(() => {
    getUsers();
  }, [refresh]);

  function getUsers() {
    setLoading(true);
    axios
      .get("http://symfony6.ge/profile")
      .then((response) => {
        setData(response.data);
        setLoading(false);
      })
      .catch((error) => {
        console.log("request failed", error);
      });
  }

  function refreshData() {
    setRefresh((prev) => !prev); // This will toggle refresh state and re-run the effect
  }

  return (
    <div className="Profile">
      <h1 style={{ textAlign: "center", marginBottom: "100px" }}>
        {loading ? (
          <Box sx={{ display: "flex" }}>
            <CircularProgress />
          </Box>
        ) : (
          `${data.length} Profiles are presented`
        )}{" "}
      </h1>
      <div style={{ display: "flex", justifyContent: "center" }}>
        {loading ? (
          <Box sx={{ display: "flex" }}>
            <CircularProgress />
          </Box>
        ) : (
          <TableContainer
            style={{ justifySelf: "center" }}
            sx={{ maxWidth: 1200 }}
            component={Paper}
          >
            <Table sx={{ minWidth: 650 }} aria-label="simple table">
              <TableHead>
                <TableRow>
                  <TableCell>id</TableCell>
                  <TableCell align="right">Name</TableCell>
                  <TableCell align="right">Surname</TableCell>
                  <TableCell align="right">Ages</TableCell>
                  <TableCell align="right">Email</TableCell>
                </TableRow>
              </TableHead>

              <TableBody>
                {data.map((item, index) => (
                  <TableRow
                    key={index}
                    sx={{ "&:last-child td, &:last-child th": { border: 0 } }}
                  >
                    <TableCell component="th" scope="row">
                      {item.id}
                    </TableCell>
                    <TableCell align="right">{item.name}</TableCell>
                    <TableCell align="right">{item.surname}</TableCell>
                    <TableCell align="right">{item.age}</TableCell>
                    <TableCell align="right">{item.email}</TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </TableContainer>
        )}
      </div>
      <UserForm refreshData={refreshData} />
    </div>
  );
}

export default Profile;
