const oracledb = require('oracledb');

async function run() {
  let connection;

  try {
    // Configuración de conexión directa
    const dbConfig = {
      user: 'G6_SC504_VT_Proyecto',
      password: '12345',
      connectString: 'localhost:1521/orcl' 
    };

    connection = await oracledb.getConnection(dbConfig);

    console.log('Connected to Oracle Database');

    const result = await connection.execute(`SELECT * FROM dual`);
    console.log(result.rows);
  } catch (err) {
    console.error('Error connecting to the database', err);
  } finally {
    if (connection) {
      try {
        await connection.close();
        console.log('Connection closed');
      } catch (err) {
        console.error('Error closing the connection', err);
      }
    }
  }
}

run();
